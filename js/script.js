function app() {
  const popup = document.querySelector('.popup');
  const formSort = document.querySelector('.main__form');

  if (formSort) {
    let getParams = new URL(document.location).searchParams;
    const sortDate = getParams.get('date') ?? '';
    const sortResponsible = getParams.get('responsible') ?? '';

    formSort.date.value = sortDate;

    if (formSort.responsible) {
      formSort.responsible.value = sortResponsible;

      formSort.responsible.addEventListener('change', function () {
        formSort.submit();
      });
    }

    formSort.date.addEventListener('change', function () {
      formSort.submit();
    });
  }

  if (popup) {
    const form = popup.querySelector('form');
    const btnTasks = document.querySelectorAll('.btn-tasks');
    const btnNewTask = document.querySelector('.btn-new-task');

    popup.addEventListener('click', (event) => {
      if (event.target == popup) {
        popup.style.display = 'none';
        form.reset();
      }
    });

    btnTasks.forEach((btn) => {
      btn.addEventListener('click', () => {
        popup.style.display = 'flex';

        const task = btn.parentElement;
        const userId = +document.querySelector('.user-id').textContent;
        const createrId = +task.querySelector('.list__cell--creater-id').textContent;

        for (let i = 0; i < form.elements.length; i++) {
          const elem = form.elements[i];
          if (userId !== createrId) {
            if (elem.name !== 'status' && elem.name !== 'btn_popup') {
              elem.tagName === 'SELECT'
                ? elem.setAttribute('disabled', 'disabled')
                : elem.setAttribute('readonly', 'readonly');
            }
          } else {
            if (elem.hasAttribute('disabled')) {
              elem.removeAttribute('disabled');
            }

            if (elem.hasAttribute('readonly')) {
              elem.removeAttribute('readonly');
            }
          }
        }

        form.id.value = form.querySelector('.popup__id').textContent = task.querySelector(
          '.list__cell--id'
        ).textContent;

        form.title.value = task.querySelector('.list__cell--title').textContent;
        form.description.value = task.querySelector('.list__cell--description').textContent;
        form.date.value = task.querySelector('.list__cell--ending-at').textContent;
        form.priority.value = +task.querySelector('.list__cell--priority-id').textContent;

        form.responsible.value = +task.querySelector('.list__cell--responsible-id').textContent;

        form.status.value = +task.querySelector('.list__cell--status-id').textContent;
        form.creater.value = createrId;

        form.btn_popup.textContent = 'Изменить';
        form.btn_popup.value = 'change';
      });
    });

    btnNewTask.addEventListener('click', () => {
      popup.style.display = 'flex';

      for (let i = 0; i < form.elements.length; i++) {
        const elem = form.elements[i];

        if (elem.hasAttribute('disabled')) {
          elem.removeAttribute('disabled');
        }

        if (elem.hasAttribute('readonly')) {
          elem.removeAttribute('readonly');
        }
      }

      form.id.value = form.querySelector('.popup__id').textContent = 'Новая';
      form.btn_popup.textContent = 'Добавить';
      form.btn_popup.value = 'new';
    });
  }
}

app();
