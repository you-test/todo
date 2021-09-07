'use strict';

{
  //checkboxのチェックの変化を送信
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.parentNode.submit();
    });
  });

  //削除
  const deletes = document.querySelectorAll('.delete');

  deletes.forEach(del => {
    del.addEventListener('click', () => {
      if (!confirm('削除してもいいかね？')) {
        return;
      }
      del.parentNode.submit();
    });
  });

  //一括削除
  const purge = document.querySelector('.purge');

  purge.addEventListener('click', () => {
    if (!confirm('削除していいんだね？本当だね！？')) {
      return;
    }
    purge.parentNode.submit();
  });

}
