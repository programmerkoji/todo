'use strict';
{
  const checkboxes = document.querySelectorAll('input[type="checkbox"]')
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.closest('form').submit();
    });
  });

  const deletes = document.querySelectorAll('.delete')
  deletes.forEach(span => {
    span.addEventListener('click', () => {
      if (!confirm('本当に削除しますか？')) {
        return;
      }
      span.parentNode.submit();
    });
  });
}
