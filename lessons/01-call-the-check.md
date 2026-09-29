# Lesson 01: a task calls the existing check

An operator requests a check for a particular device. A task carries that device's ID; the check class owns the rules for deciding and saving its status. This keeps those rules in one place when we later add queued execution.

Work in `app/Tasks/CheckDevice.php`, inside `handle()`.

Already supplied:
- The constructor stores the requested ID in `$this->deviceId`.
- `DeviceCheck` is imported at the top of the file.
- `DeviceCheck::run(int $deviceId)` is an ordinary instance method: it retrieves the current record, decides its status, and saves it. It returns nothing.
- `php artisan device:run-task 1` constructs a task for device 1 and calls `handle()` immediately. There is no queue yet.

Your task: replace the placeholder exception with code that creates a `DeviceCheck` object and calls its `run()` method with this task's stored ID. Do not hardcode 1 or copy the checking logic into the task.

A separate example of the syntax:

```php
$printer = new ReportPrinter;
$printer->printReport($this->reportId);
```

That example's class and property are not part of this project.

Check your attempt with `composer test:lesson`. The lesson test deliberately fails until you implement `handle()`. It checks the selected device, leaves another device untouched, and covers fresh, expired, and missing heartbeats.

`composer test` checks supplied scaffolding only. Passing it does not mean the exercise is complete.
