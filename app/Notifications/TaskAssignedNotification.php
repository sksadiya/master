<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class TaskAssignedNotification extends Notification
{
    use Queueable;
   protected $task;
      /**
     * Create a new notification instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'type' => 'Task',
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'assigned_by' => $this->task->assigned_by,
            'message' => 'You have been assigned a new task: ' . $this->task->title ,
            'url' => route('task.show', $this->task->id),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'assigned_by' => $this->task->assigned_by,
            'message' => 'You have been assigned a new task: ' . $this->task->title,
            'url' => route('task.show', $this->task->id),
        ];
    }
}
