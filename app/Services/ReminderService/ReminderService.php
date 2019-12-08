<?php


namespace App\Services\ReminderService;



use App\Services\ReminderService\ReminderRepository\ReminderRepository;

class ReminderService
{
    /**
     * @var ReminderRepository
     */
    protected $repository;
    public function __construct(ReminderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function Send(ReminderObjectValue $reminder)
    {

        $this->repository->add([
            'parent_id'=>$reminder->getParentId(),
            'title'=>$reminder->getTitle(),
            'description'=>$reminder->getDesctiprion(),
            'receiver_type'=>$reminder->getReceiverName(),
            'receiver_id'=>$reminder->getReceiverId(),
            'sender_type'=>$reminder->getSenderName(),
            'sender_id'=>$reminder->getSenderId(),
            'state'=>$reminder->getState(),
            'status'=>$reminder->getStatus(),
            'execute_at'=>$reminder->getExecuteAt()->format('Y-m-d H:i:s'),
            'reminder_at'=>$reminder->getReminderAt()->format('Y-m-d H:i:s'),
            'notify_type'=>$reminder->getNotifyTypeCode(),
            'created_by'=>auth()->id(),
        ]);
    }

    public function Edit(ReminderObjectValue $reminder)
    {

        $this->repository->edit([
            'id'=>$reminder->getId(),
            'parent_id'=>$reminder->getParentId(),
            'title'=>$reminder->getTitle(),
            'description'=>$reminder->getDesctiprion(),
            'receiver_type'=>$reminder->getReceiverName(),
            'receiver_id'=>$reminder->getReceiverId(),
            'sender_type'=>$reminder->getSenderName(),
            'sender_id'=>$reminder->getSenderId(),
            'state'=>$reminder->getState(),
            'status'=>$reminder->getStatus(),
            'execute_at'=>$reminder->getExecuteAt()->format('Y-m-d H:i:s'),
            'reminder_at'=>$reminder->getReminderAt()->format('Y-m-d H:i:s'),
            'notify_type'=>$reminder->getNotifyTypeCode(),
            'created_by'=>auth()->id(),
        ]);
    }
    public function show(ReminderObjectValue $reminder)
    {

        return $this->repository->find( $reminder->getId());
    }

    public function destroy(ReminderObjectValue $reminder)
    {

        return $this->repository->destroy( $reminder->getId());
    }

    public function paginate($perPage=15)
    {
        return $this->repository->paginate($perPage);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function UsersReminder(array $user_ids,$date_from,$date_to)
    {
        return $this->repository->UsersReminder($user_ids,$date_from,$date_to);

    }
    public function clientsReminder($date_from,$date_to)
    {
        return $this->repository->clientsReminder($date_from,$date_to);

    }
    public function personnelsReminder($date_from,$date_to)
    {
        return $this->repository->personnelsReminder($date_from,$date_to);

    }
    public function ContactReminder( $contact_id,$date_from,$date_to)
    {
        return $this->repository->ContactReminder($contact_id,$date_from,$date_to);

    }
}