<main class="main">
    <div class="container">
        <h1 class="main__title">Задачи</h1>
        <div class="main__header">
            <button class="btn btn--transparent btn-new-task">Новая задача</button>
            <form class="main__form" method="GET" action="/">
                <label for="form__select-date">По дате завершения:</label>
                <select id="form__select-date" name="date" class="input">
                    <option value="">Без группировки</option>
                    <option value="today">Сегодня</option>
                    <option value="week">На неделю</option>
                    <option value="future">На будущее</option>
                </select>
                <?php if (count($data->users)): ?>
                    <label for="form__select-user">По отвественным:</label>
                    <select id="form__select-user" name="responsible" class="input">
                        <option value="">Без группировки</option>
                        <?php foreach ($data->users as $user): ?>
                            <option value="<?= $user->id ?>"><?= $user->name ?> <?= $user->surname ?></option>
                        <?php endforeach ?>  
                    </select>
                <?php endif ?>
            </form>
        </div>
        <ul class="main__list list">
            <li class="list__item">
                <div class="list__cell list__cell--bold">Номер</div>
                <div class="list__cell list__cell--bold">Название</div>
                <div class="list__cell list__cell--bold">Приоритет</div>
                <div class="list__cell list__cell--bold">Дата окончания</div>
                <div class="list__cell list__cell--bold">Ответственный</div>
                <div class="list__cell list__cell--bold">Статус</div>
            </li>
            <?php foreach ($data as $task) : ?>
                <li class="list__item">
                    <div class="list__cell list__cell--id"><?= $task->id ?></div>
                    <div class="list__cell list__cell--title <?= getColorTask($task->ending_at, $task->status->id) ?>"><?= $task->title ?></div>
                    <div class="list__cell list__cell--priority"><?= $task->priority->description ?></div>
                    <div class="list__cell--priority-id" hidden><?= $task->priority->id ?></div>
                    <div class="list__cell list__cell--ending-at"><?= $task->ending_at ?></div>
                    <div class="list__cell list__cell--responsible"><?= $task->responsible->name . ' ' . $task->responsible->surname ?></div>
                    <div class="list__cell--responsible-id" hidden><?= $task->responsible->id ?></div>
                    <div class="list__cell--creater-id" hidden><?= $task->creater->id ?></div>
                    <div class="list__cell list__cell--status"><?= $task->status->description ?></div>
                    <div class="list__cell--status-id" hidden><?= $task->status->id ?></div>
                    <div class="list__cell--description" hidden><?= $task->description ?></div>
                    <button class="btn btn--transparent btn-tasks">Изменить</button>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</main>

<div class="popup">
    <form class="popup__form" method="POST" action="/">
        <h3 class="popup__title">Задача - <span class="popup__id"></span></h3>
        <input type="hidden" name="id">
        <input type="hidden" name="creater">
        <label for="popup-title">Заголовок</label>
        <input id="popup-title" class="input" name="title" type="text" required minlength="3">
        <label for="popup-description">Описание</label>
        <textarea id="popup-description" class="input input--textarea" name="description" required minlength="3"></textarea>
        <label for="popup-date">Дата окончания</label>
        <input id="popup-date" class="input" name="date" type="date" required>
        <label for="popup-priority">Приоритет</label>
        <select id="popup-priority" class="input" name="priority">
            <?php foreach ($data->prioritys as $priority): ?>
                <option value="<?= $priority->id ?>"><?= $priority->description ?></option>
            <?php endforeach ?>  
        </select>
        <label for="popup-status">Статус</label>
        <select id="popup-status" class="input" name="status">
            <?php foreach ($data->statuses as $status): ?>
                <option value="<?= $status->id ?>"><?= $status->description ?></option>
            <?php endforeach ?>  
        </select>
        <label for="popup-responsible">Ответственный</label>
        <select id="popup-responsible" class="input" name="responsible">
            <option value="<?= $_SESSION['user']['id'] ?>">Я</option>
            <?php foreach ($data->users as $user): ?>
                <option value="<?= $user->id ?>"><?= $user->name ?> <?= $user->surname ?></option>
            <?php endforeach ?>  
        </select>
        <button type="submit" class="btn btn--solid" name="btn_popup" value="new">Изменить</button>
    </form>
</div>