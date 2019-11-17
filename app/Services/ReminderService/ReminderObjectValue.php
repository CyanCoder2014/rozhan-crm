<?php


namespace App\Services\ReminderService;


class ReminderObjectValue
{
    protected $id;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $desctiprion;
    /**
     * @var \DateTime
     */
    protected $reminderAt;
    /**
     * @var \DateTime
     */
    protected $executeAt;
    /**
     * @var integer
     */
    protected $model_id;
    /**
     * @var string
     */
    protected $model_name;
    /**
     * @var integer
     */
    protected $parent_id;
    /**
     * @var integer
     */
    protected $state=0;
    /**
     * @var integer
     */
    protected $status=0;
    /**
     * @var bool
     */
    protected $db=true;
    /**
     * @var bool
     */
    protected $email=false;
    /**
     * @var bool
     */
    protected $sms=false;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self 
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDesctiprion(): string
    {
        return $this->desctiprion;
    }

    /**
     * @param string $desctiprion
     */
    public function setDesctiprion(string $desctiprion): self
    {
        $this->desctiprion = $desctiprion;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReminderAt(): \DateTime
    {
        return $this->reminderAt;
    }

    /**
     * @param \DateTime $reminderAt
     */
    public function setReminderAt(\DateTime $reminderAt): self
    {
        $this->reminderAt = $reminderAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExecuteAt(): \DateTime
    {
        return $this->executeAt;
    }

    /**
     * @param \DateTime $executeAt
     */
    public function setExecuteAt(\DateTime $executeAt): self 
    {
        $this->executeAt = $executeAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getModelId(): int
    {
        return $this->model_id;
    }

    /**
     * @param int $model_id
     */
    public function setModelId(int $model_id): self
    {
        $this->model_id = $model_id;
        return $this;

    }

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->model_name;
    }

    /**
     * @param string $model_name
     */
    public function setModelName(string $model_name): self 
    {
        $this->model_name = $model_name;
        return $this;

    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId(int $parent_id): self
    {
        $this->parent_id = $parent_id;
        return $this;

    }

    /**
     * @return bool
     */
    public function isDb(): bool
    {
        return $this->db;
    }

    /**
     * @param bool $db
     */
    public function setDb(bool $db): self 
    {
        $this->db = $db;
        return $this;

    }

    /**
     * @return bool
     */
    public function isEmail(): bool
    {
        return $this->email;
    }

    /**
     * @param bool $email
     */
    public function setEmail(bool $email): self
    {
        $this->email = $email;
        return $this;

    }

    /**
     * @return bool
     */
    public function isSms(): bool
    {
        return $this->sms;
    }

    /**
     * @param bool $sms
     */
    public function setSms(bool $sms): self
    {
        $this->sms = $sms;
        return $this;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState(int $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     * [
        'db' => 1,
        'email' => 2,
        'db+email' => 3,
        'sms' => 4,
        'sms+db' => 5,
        'sms+email' => 6,
        'sms+email+db' => 7,
        ]
     */
    public function getNotifyTypeCode(){
        $notify_type=0;
        if ($this->isDb())
            $notify_type += 1;
        if ($this->isEmail())
            $notify_type += 2;
        if ($this->isSms())
            $notify_type += 4;
        return $notify_type;
    }


}