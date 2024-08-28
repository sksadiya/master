<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Expense;
class ExpenseAddedNotification extends Notification
{
    use Queueable;
    protected $expense;
    /**
     * Create a new notification instance.
     */
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
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
     * Get the array representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return [
            'expense_id' => $this->expense->id,
            'amount' => $this->expense->amount,
            'employee' => $this->expense->member->name, // Adjust based on your relationship
            'message' => 'A new expense has been added by ' . $this->expense->member->name.'of amount '. $this->expense->amount,
            'url' => route('expense.show', $this->expense->id), // Adjust the route
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'expense_id' => $this->expense->id,
            'amount' => $this->expense->amount,
            'employee' => $this->expense->member->name, // Adjust based on your relationship
            'message' => 'A new expense has been added by ' . $this->expense->member->name.'of amount '. $this->expense->amount,
            'url' => route('expense.show', $this->expense->id), // Adjust the route
        ];
    }
}
