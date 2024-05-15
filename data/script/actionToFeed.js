const likes = document.querySelectorAll('.like')
const buttonComments = document.querySelectorAll('.comment');
const blocsComments = document.querySelectorAll('.ctn-cmt');
const btnsComments = document.querySelectorAll('.commenter');
const inputsComment = document.querySelectorAll('.input-cmt')

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

buttonComments.forEach(buttonComment => {
    buttonComment.addEventListener('click', function() {
        blocsComments.forEach(blocCmt => {
            if (blocCmt.id == this.id) {
                if (blocCmt.style.display == "flex") {
                    blocCmt.style.display = "none";
                } else {
                    blocCmt.style.display = "flex";
                }
            }
        })
    });
});


btnsComments.forEach(btnComment => {
    btnComment.addEventListener('click', function() {
        inputsComment.forEach(inputComment => {
            if (inputComment.id == this.id) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../controller/actionToFeed.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log('L\'action a été enregistrée sur le serveur.');
                    }
                };
                xhr.send('comment=' + encodeURIComponent(inputComment.value)
                            + '&idFile=' + encodeURIComponent(this.id));
                inputComment.value = '';
            }
        });
    });
});