<?php
namespace Application\Service\GSManager;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Validator\EmailAddress;

class GSManager implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    const REDIS_KEY_PREFIX  = __CLASS__.'::';
    const REDIS_MEMBERS_KEY = 'Members';
    const REDIS_COUNTER_KEY = 'MembersCounter';
    private $redis;
    private $membersCounter;
    private $lastInsertedId;

    public function __construct()
    {
        $r = new \Redis();
        $r->connect('redis-server');
        $r->setOption(\Redis::OPT_PREFIX, self::REDIS_KEY_PREFIX);
        $r->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);
        $r->select(0);
        $c = $r->get(self::REDIS_COUNTER_KEY);
        if (empty($c)) {
            $this->membersCounter = 0;
            $r->del([self::REDIS_MEMBERS_KEY]);
        }
        else $this->membersCounter = $c;
        $this->redis = $r;
    }

    public function getMember(string $id) : array
    {
        $field = base64_decode($id);
        $valid = new EmailAddress();
        if ($valid->isValid($field))
            return $this->redis->hGet(self::REDIS_MEMBERS_KEY, $field);
        else
            throw new \RuntimeException('Given id is not valid', 422);
    }

    public function addMember(array $member) : GSManager
    {
        $this->getEventManager()->trigger('add.member.pre', $this, ['member' => $member]);
        $res = $this->redis->hSetNx(self::REDIS_MEMBERS_KEY, $member['email'], $member);
        if ($res) {
            $this->lastInsertedId = base64_encode($member['email']);
            $this->redis->incr(self::REDIS_COUNTER_KEY);
        } else {
            throw new \RuntimeException('Could not add member to the system.', 500);
        }
        $this->getEventManager()->trigger('add.member.post', $this, ['member' => $member, 'result' => $res]);
        return $this;
    }

    public function removeMember(string $id) : GSManager
    {
        $field = base64_decode($id);
        $valid = new EmailAddress();
        if ($valid->isValid($field)) {
            $this->getEventManager()->trigger('remove.member.pre', $this, ['id' => $id, 'field' => $field]);
            $res = $this->redis->hDel(self::REDIS_MEMBERS_KEY, $field);
            $this->getEventManager()->trigger('remove.member.post', $this, ['id' => $id, 'field' => $field, 'result' => $res]);
        } else {
            throw new \RuntimeException('Given id is not valid', 422);
        }
        return $this;
    }

    public function getAllMembers() : array
    {
        $allmembers = $this->redis->hGetAll(self::REDIS_MEMBERS_KEY);
        foreach ($allmembers as $k => $member) {
            $ret[] = $member;
        }
        return $ret;
    }

    public function getLastInsertedId() : string
    {
        return $this->lastInsertedId;
    }
}
