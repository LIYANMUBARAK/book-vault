<p>Hi {{ $borrowRecord->user->name }},</p>

<p>This is a reminder that the book <strong>{{ $borrowRecord->book->title }}</strong> you borrowed is overdue.</p>

<p>Borrowed at: {{ $borrowRecord->borrowed_at->format('d M Y') }}<br>
Due date: {{ $borrowRecord->due_date->format('d M Y') }}</p>

<p>Please return it as soon as possible.</p>

<p>Thank you,<br>Library Team</p>
