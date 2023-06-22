'use strict';

const postID = window.location.search.split('=')[1];

console.log(window.location.search.split('=')[1]);
fetch(`https://jsonplaceholder.typicode.com/posts/${postID}`)
  .then((response) => response.json())
  .then((singlePost) => {
    console.log(singlePost);
    const singlePostContainer = document.querySelector(
      '#single_post_container'
    );

    const div = document.createElement('div');
    div.classList.add('single_post');

    const singlePostBody = document.createElement('div');
    singlePostBody.classList.add('single_post_body');

    const singleTitle = document.createElement('h1');
    singleTitle.textContent = singlePost.title;
    singleTitle.classList.add('title');
    singlePostBody.insertAdjacentElement('beforeend', singleTitle);

    const singleContent = document.createElement('p');
    singleContent.textContent = singlePost.body;
    singleContent.classList.add('body');
    singlePostBody.insertAdjacentElement('beforeend', singleContent);

    div.insertAdjacentElement('beforeend', singlePostBody);

    singlePostContainer.insertAdjacentElement('afterbegin', div);
  });

fetch(`https://jsonplaceholder.typicode.com/posts/${postID}/comments`)
  .then((response) => response.json())
  .then((comments) => {
    const singlePostComments = document.querySelector('.single_post_comments');

    const sectionTitle = document.createElement('h2');
    sectionTitle.textContent = 'Comments:';
    singlePostComments.insertAdjacentElement('beforebegin', sectionTitle);

    comments.forEach((comment) => {
      const email = comment.email,
        name = comment.name,
        body = comment.body;

      const commentItem = document.createElement('div');
      commentItem.classList.add('comment');

      const commentEmail = document.createElement('h4');
      commentEmail.textContent = email;
      commentEmail.classList.add('commentEmail');
      commentItem.insertAdjacentElement('beforeend', commentEmail);

      const commentTitle = document.createElement('h3');
      commentTitle.textContent = name;
      commentTitle.classList.add('commentTitle');
      commentItem.insertAdjacentElement('beforeend', commentTitle);

      const commentBody = document.createElement('p');
      commentBody.textContent = body;
      commentBody.classList.add('commentBody');
      commentItem.insertAdjacentElement('beforeend', commentBody);

      singlePostComments.insertAdjacentElement('beforeend', commentItem);
    });
  });
