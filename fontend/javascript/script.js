const modal = document.getElementById('modal_edit');

modal.addEventListener('show.bs.modal', function (event) {

    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    // const content = button.getAttribute('data-content');

    document.getElementById('edit-id').value = id;
    // document.getElementById('edit-content').value = content;

});