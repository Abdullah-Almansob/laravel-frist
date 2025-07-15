
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('input[name="username"]');
        if (!searchInput) return;
        const searchForm = searchInput.closest('form');

        searchInput.addEventListener("input", function() {
            if (this.value.trim() === '') {
                searchForm.submit();
            }
        });
    });

  

 
        const deleteButtons = document.querySelectorAll('.btnDelete');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const url = `/post/${postId}`;
                deleteForm.setAttribute('action', url);
                console.log("Set form action to:", url);
            });
        });
   




