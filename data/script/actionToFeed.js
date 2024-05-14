const likes = document.querySelectorAll('.like')
const comments = document.querySelectorAll('.comment');
const blocComment = document.querySelectorAll('.ctn-cmt');

likes.forEach(like => {
    like.addEventListener('click', function() {
        console.log(this.id);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../controller/actionToFeed.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log('L\'action a été enregistrée sur le serveur.');
            }
        };
        xhr.send('filename=' + encodeURIComponent(this.id));

    });
});

comments.forEach(comment => {
    comment.addEventListener('click', function() {
        blocComment.forEach(c => {
            if (c.id == this.id) {
                if (c.style.display == "flex") {
                    c.style.display = "none";
                } else {
                    c.style.display = "flex";
                }
            }
        })
    });
});