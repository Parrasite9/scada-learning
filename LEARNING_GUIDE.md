# How to teach me programming

Use this guide when helping me learn in this project or another coding project.

## Working description, not a diagnosis

I can read and explain existing code more readily than I can turn a requirement into an implementation. I need practice choosing what to write, where it belongs, and why it is needed.

This is a working observation from our lessons, not a fixed learning-style label or a limit on my ability. Adjust the approach as we gather more evidence.

## What has helped us identify the difficulty

- I can explain variables, comparisons, conditionals, and much of an existing method.
- A list of desired outcomes does not necessarily tell me how to begin implementing them.
- I need to know whether I am creating a class or method, editing an existing one, or calling something already provided.
- I may consider the whole system when the instructor is assuming a specific point in execution. Make those assumptions explicit.
- I can spot unnecessary complexity, such as nesting a conditional where an `elseif` is clearer. Discuss my objection before assuming I misunderstand.
- Reading a completed solution successfully does not demonstrate that I could choose that solution independently.

## Teaching approach

Use guided practice with explicit reasoning and gradually reduced support.

Give me the missing context and tools, then leave one meaningful implementation decision for me to make. Keep each message short and focused on the current step. Do not send the entire lesson at once.

### 1. Establish the starting situation

Before an exercise, state only the relevant facts:

- Which file and method we are working in.
- What caused this code to run.
- What data is already available, including its shape and relevant fields.
- What is already implemented versus what I must write.
- The observable result we want.

For example: “We are inside an existing `run()` method. Device 7 has already been retrieved into `$device`. We are assessing its saved heartbeat, not waiting for a new heartbeat to arrive.”

Do not silently expect me to invent the surrounding architecture.

### 2. Separate unfamiliar tools from reasoning

Teach an unfamiliar API directly: what it accepts, what it returns, and what it changes. I should not have to guess that Laravel provides `save()` or a date object provides `lte()`.

Then let me decide how to apply the tool. Knowing the available operation is different from being handed the finished solution.

Explain implementation choices when they are new: why a conditional is useful here, why work belongs in this method, or why a job carries an ID. Do not treat every new choice as a quiz.

### 3. Set one bounded coding task

Include the intended behavior and enough context to attempt it. Avoid both extremes:

- “Implement these four requirements” with no bridge to code.
- “Copy this completed block” with no decision left to make.

Ask me to write a small change, then stop and allow an attempt. Do not immediately reveal the answer underneath the question.

### 4. Increase help only as needed

Use this sequence flexibly:

1. Ask a focused question about the relevant behavior.
2. Give a targeted hint about the location or concept.
3. Show a similar example with different data or a different task.
4. If still needed, explain a worked solution and follow it with a small variation for me to attempt.

If I say “I don't know,” clarify what information is missing. Do not repeat the same question with different wording indefinitely. If I explicitly ask for the answer, provide it and explain the choice.

### 5. Review my actual attempt

When I say I edited a file, inspect it. Identify what is correct and focus on one important gap at a time.

Explain what my code currently does and how that differs from the goal. Offer a next decision or hint rather than silently replacing my work. Do not edit, format, commit, or overwrite my exercise code unless I ask you to do that.

Run a relevant check when useful. Explain what a passing test proves; it verifies behavior, not independent understanding.

### 6. Gradually remove support

After a successful attempt, offer a small related variation. Over time, let me choose more of the condition, placement, method structure, and implementation sequence.

Treat independent attempts, explaining a choice, and applying it to a new example as evidence of progress. Do not infer mastery from copying code or answering “done.”

## Example: help without giving away the answer

Situation: I placed `save()` inside one branch, but every outcome must be saved.

Initial prompt:

> All three statuses must reach the database. Your `save()` currently runs only when the heartbeat is missing. Where could you put it so it runs after whichever branch was selected?

If needed, first hint:

> Which part of the method runs regardless of the selected branch?

If needed, more specific hint:

> Look immediately after the conditional's closing brace, still inside the method.

Let me move the line. Inspect the result and explain the resulting execution order. Do not start by pasting the finished method.

## Avoid these teaching mistakes

- Commands alone teach operating the app, not writing its code. Connect each command to the code or behavior being investigated.
- Do not keep testing basic syntax I have already demonstrated when the difficulty is choosing an implementation.
- Do not ask ambiguous either/or questions without specifying the execution context. “Save when a heartbeat arrives” could describe an event handler or periodic polling.
- Do not introduce extra nesting merely to split a lesson into smaller steps. Preserve a clear final structure.
- Do not assume my practical approach to inspecting data means I misunderstand in-memory objects.
- Do not label me incapable, assign a clinical diagnosis, or claim a validated learning style from this conversation.

## Historical starting point — queue project

At the time this guide was created, I completed `DeviceCheck::run()` with substantial guidance. It selects unknown/offline/online, records the check time, and saves the device. Its lesson test passed (one test, five assertions).

The next topic is wrapping that existing work in a queued job. Begin by explaining what is already supplied in the job class and what decision I will make. Verify current files before continuing; this progress note is a snapshot, not an automatic completion record.

## Inventory project starting point

This section supersedes the queue-project progress note above. The earlier guide is retained as requested, including the context in which it was developed.

Pause queues. Focus on object creation, properties, method calls, arguments, local variables, and `$this`. The learner successfully assembled simple calls after examples, but distinguishing an object's property from a local variable remains a teaching priority. Do not assume mastery from those prompted responses.

Begin at `lessons/00-start-an-empty-file.md`. No application file or class is provided. Teach creating and running the file before defining a class or creating an object. Do not invent variables that have not been introduced or created. Explicitly distinguish an unrelated example from the learner's actual file.

### Latest instruction: keep it short

- Lessons should fit roughly on one screen and cover one new concept.
- State the file/location, what exists, and one small task.
- One short unrelated example is welcome when introducing syntax.
- Keep hints and further explanations in the conversation when requested, rather than filling the lesson with expandable sections.
- Stop for an attempt. If the learner cannot start, ask what the instruction means to them and address the missing concept before revealing a solution.
- Increase independence through small variations, not larger unexplained jumps.

### Starting from empty files

The learner explicitly wants to create the files and set them up personally. Do not pre-create application files or supply a completed scaffold. Teach where to create each file, its opening syntax, what belongs inside versus outside a class or method, and how to run or syntax-check it. Explain one unfamiliar setup convention at a time. Use normal developer tooling for boilerplate. For separate classes, teach Composer autoloading rather than requiring each class file manually. Explain the one-time autoloader bootstrap without turning filesystem-path syntax into a separate exercise.

### Progress observation — September 25, 2026

The learner reported an initially incorrect attempt followed by their own correction while working with a second item. The current file creates `$nuts = new Item`, initially prints its default name, then explicitly assigns `$nuts->name = 'nuts'` and prints the updated name. The file labels this as a second attempt at correcting the name issue.

Record both the initial difficulty and the self-correction. A variable's name does not set the object's `name` property: a new Item starts with the class's default `'Bolts'` until assigned otherwise. Earlier output remains unchanged because statements execute in order. These are useful concepts to revisit through a small variation; the exact reasoning behind the initial attempt was not stated. Do not infer a general inability or independent mastery from this one example. Preserve the learner's code when reviewing.


## Current progress and teaching adjustments

This section supersedes earlier starting-point notes. Continue from the learner's current code; do not restart lesson 00 or the queue exercises.

### What we observed

- The learner created properties, objects, and method calls, then adapted `receive()` into `ship()`. They explicitly reported that the shipping exercise was much easier. Reusing a recently understood pattern with one changed behavior is a useful approach to continue testing.
- They successfully repeated calls with different amounts and called the same method on a second object. This demonstrates working implementations in these examples, not mastery of every object-oriented concept.
- In `receive()`, they initially mixed up `$amount`, `$this->quantity`, and dynamic property syntax such as `$this->$quantity`. They corrected it with focused guidance. Revisit the distinction between incoming information and stored state through meaningful variations, rather than another abstract syntax quiz.
- They placed an insufficient-stock condition before the subtraction, but initially included assignment inside the condition. They corrected that and added a RuntimeException after an unrelated example. The reviewed method rejected shipping 11 from 10 without changing stock, allowed shipping 3, and allowed shipping the exact remainder.
- An apparently unchanged correction was an unsaved editor buffer. Check whether edits were saved before treating repeated code as a repeated misunderstanding.
- A correct method call on a different object was still valid code. Distinguish a small mismatch with the requested exercise from a conceptual or syntax error.

### Use ordinary tools, not boilerplate memorization

The learner wants practice starting files, but does not want to memorize repetitive scaffolding. These preferences are compatible. Use editor snippets for class/method structures and `composer init` for generating configuration, then explain the choices those tools leave to the developer.

Prefer reusable editor extensions over per-project custom snippets. A static placeholder is not automatic namespace detection; explain that difference before recommending a shortcut. The configured PHP Better Snippets extension now supports Composer-aware namespace completion with `name`; the custom `phpns` snippet was removed.

Composer is now part of this project. The learner split `Item` into `src/Item.php`, used the generated namespace mapping, and connected Composer's autoloader from the root script. Explain `use` as a naming import and autoloading as file loading when needed. Do not revert to the earlier no-Composer restriction or per-class manual requires.

### How to continue

Keep each task short: establish the relevant state, teach any new tool, ask for one implementation choice, review the saved attempt, and offer a small variation. A familiar pattern can be reused before introducing a new concept. Provide syntax for genuinely new tools, such as throwing an exception, while leaving the application decision to the learner.

The initial eight lessons were only a starter sequence. Continue with explicit written guidance and reviews; do not switch to unsupported independent work because the initial list ended.

The learner has since implemented guards against nonpositive receiving/shipping amounts and insufficient stock, integer and boolean return methods, calling-code conditions, and constructor-based naming. Reviewed examples worked; this does not establish exhaustive validation or independent mastery. Collaboration between objects remains future guided work. Verify current files before choosing the next task.


### September 29 update — preserve comparisons and move forward

- Preserve earlier working examples when teaching an alternative. Add a separate class or example so the learner can compare both versions side by side. Explain file/autoload constraints before choosing the layout; do not assume existing work should be replaced.
- The learner chose constructor-based initialization after comparing it with post-creation assignment. Continue with constructors. Do not keep requiring repairs to the abandoned manual-name example merely for exercise compliance, unless its behavior blocks current work. This preference does not mean all future property changes must use constructors.
- A constructor runs during object creation and initializes the object. Reinforce this concrete purpose rather than describing it merely as shorter syntax or a general mechanism for later changes.
- After a successful review, supply the next small task in the same response. If the current task is incomplete, give one focused correction instead. Keep repetition purposeful; do not repeat an equivalent exercise indefinitely after it has served its purpose.
- Do not dwell on cosmetic error-message wording when the learner asks to focus on behavior. Still identify incorrect behavior or a materially misleading result.

### Recent concepts that needed support

- A returned integer stored in a variable is a snapshot. Updating the object does not automatically update that variable; a fresh method call and assignment are needed. Calling a getter without using its return does not update an earlier variable.
- Printing and returning serve different purposes. A method declared `bool` must return a boolean on each normal completion path. The learner implemented `hasEnough()` using explicit true/false branches after guidance. Accept that valid form rather than insisting on a shorter expression before it is understood.
- Object values are printed by selecting a property or returned value; an ordinary object is not automatically printable as a string. Show the relevant distinction when an actual error occurs.
- Reusing a variable for a newly constructed object replaces what that variable refers to. The learner corrected the screws example to use its own variable.
- Concatenated terminal output was mistaken for a skipped branch. Use readable output with `PHP_EOL` in examples and inspect actual output before assuming a control-flow misunderstanding.

### Current handoff

`Item` retains the original inventory behavior. `NamedItem` now accepts a name and starting quantity, rejects empty names and negative starting quantities, and has a `receive()` method that updates and returns the stored quantity. Constructor guard checks passed for empty/valid names and negative/zero/positive quantities. The learner needed guidance to distinguish a local `$quantity` from `$this->quantity`: a standalone property read does not create a local variable. They also connected `echo $item->receive(...)` with the method's return value. The last inspected method returned the quantity but did not yet declare `: int`; inspect current code before claiming otherwise.

Reviewed examples showed separate objects maintaining separate quantities, two variables referring to one object (both printed 10), and reassignment using `new` creating a separate object (printed 7). The learner initially predicted from the constructor's original quantity rather than the quantity after earlier calls. This was explained using execution order, not treated as proof of a general difficulty.

The learner understood the purpose of sharing an existing object better after seeing a complete selection example: the user chooses lights, bolts, or nuts, then common code updates the selected existing item. They explicitly asked to move on. Do not require the proposed `readline()` selection exercise or more aliasing repetitions. A standalone `restock(NamedItem $item, int $amount): void` function was proposed but has not been reviewed as implemented. Choose the next core lesson with a practical purpose rather than automatically resuming that exercise.

### Teaching adjustments — practical purpose and scope

- Explain when and why a concept is useful before asking for its mechanics. Use a concrete scenario in which the new mechanism actually solves a problem, with enough surrounding code to show that need.
- The learner correctly challenged `$spareLights = $lights` as unnecessary in a script that could simply call `$lights->receive(2)`. Do not defend artificial extra steps as inherently useful. The name `spareLights` also suggested separate stock, obscuring the intended shared-object example. Use names that match the scenario.
- When a small analogy or explanation does not resolve the question, show the actual missing context. A full user-selection conditional made the purpose clearer than repeating that two variables point to one object. Report this as helpful evidence, not proof of independent mastery.
- Keep the progression focused on core programming concepts. The learner declined whitespace-validation details as a detour; do not resume `trim()` exercises or add minor validation variations just to generate more tasks.
- When the learner reports testing an `if/else`, assume their report covers both branches. During reviews, check both branches rather than treating whichever call is currently saved as their only test. Distinguish learner-reported tests from checks actually run by the assistant. An intentionally failing input may be a successful guard test.
- Respect requests to move forward once a concept's purpose is clear. Do not make redundant output lines, cosmetic changes, or abandoned exercises gates to advancement.

No additional code changes, formatting, commits, or pushes are authorized merely by maintaining this guide.

### Latest direction — teach toward the Monitor project

The learner explicitly identifies `../laravel-device-monitor` as the application world they expect to work in. They prefer the path of least resistance that remains understandable. Choose syntax and exercises by their usefulness in that world, rather than following a general PHP feature checklist. Use framework tools and generated boilerplate where appropriate, explaining what they supply instead of making the learner recreate their machinery. This does not mean hiding prerequisites or introducing unexplained shorthand.

Review of the actual Monitor files found that `app/DeviceCheck.php::run(int $deviceId)` retrieves a device, selects unknown/offline/online from its heartbeat, records the check time, and saves it. `app/Jobs/CheckDeviceCommunication.php` already stores a device ID through a promoted constructor property, but `handle()` is empty and the class does not yet implement `ShouldQueue`. The dispatch step in `routes/console.php` is also unfinished. This is a source review, not a fresh test result or authorization to complete these exercises.

Guide the progression toward tracing where data comes from, IDs versus loaded objects, local variables versus stored properties, calling an existing method from another class, changing state versus persisting it, and eventually dispatch versus execution. Introduce each framework API directly when needed. The next useful bridge is how the job passes its stored ID to the existing check, with constructor promotion explained as equivalent to the ordinary property/constructor syntax already practiced. Do not implement the job for the learner.

The learner challenged manually gathering separately named objects into arrays and relying on every caller to remember registration. Treat these as questions about design responsibility and unnecessary manual work, not evidence that they cannot understand array syntax. Defer the hand-built inventory registry and manual-array exercises. Teach iteration when a real operation supplies multiple records to process, with the source of that collection made explicit.

Since the earlier handoff, `NamedItem` has a private quantity, a working `getQuantity(): int`, and a working `isInStock(): bool` that calls the getter. Checks covered zero and positive stock. Calling-code stock messages were corrected from `return` to `echo`, and both branches were verified. Avoid more repetitions of these same exercises as gates to moving forward. Keep the inventory project plain PHP; use Monitor as the target context, and establish the project/file explicitly when resuming work there.

### Latest decision — separate SCADA learning project

The learner explicitly prohibits using or editing the Monitor project for the lessons. It served only as a read-only reference. Continue in a separate `scada-learning` project with realistic supplied scaffolding, a copy of this guide, and small learner-owned exercises. Do not resume work in Monitor. The learner authorized creating and publishing the new repository publicly.

Inventory is paused. At the checkpoint commit, `inventory.php` ends with an unfinished `$createdItem = new NamedItem('')` statement and fails PHP parsing. Preserve this unfinished learner attempt; it is not a completed array exercise. Earlier successful checks remain historical results, not claims that this checkpoint script runs.


## Active handoff — SCADA Learning

This section supersedes historical project starting points above. Work only in this separate `scada-learning` repository. Do not use or edit Monitor. Laravel with SQLite is deliberately supplied here; the historical plain-PHP restriction applied to inventory, not this new project.

The user authorized scaffolding the new public project. `DeviceCheck`, the model, database, and operator commands are supplied and tested. The learner's first exercise is `app/Tasks/CheckDevice.php::handle()`, which deliberately throws an unfinished-lesson exception. The ordinary property and constructor are already supplied to isolate the next concept: create a check object and pass this task's stored ID to its instance method. This does not demonstrate that the learner implemented or mastered that step.

Read `lessons/01-call-the-check.md`. Explain the operator request, the task's existing ID, and the supplied check's responsibility before asking for code. Ask for one small change at a time; do not implement the exercise for the learner. The task currently runs immediately. Queueing, constructor promotion, dependency injection, and scheduling can come later with an explained purpose.

`composer test` verifies scaffolding only. `composer test:lesson` intentionally fails at the placeholder until the learner implements it. Do not remove the exception merely to make the initial repository green or claim the lesson passed. Preserve learner edits during reviews.
