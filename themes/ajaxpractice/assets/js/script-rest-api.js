'use strict';

async function fetchPosts() {
  const response = await fetch(`https://jsonplaceholder.typicode.com/posts`);
  const postsGet = await response.json();
  postsGet.forEach((item) => {
    if (item.id <= 12) {
      const postsContainer = document.querySelector('#posts_container'),
        postID = item.id,
        postTitle = item.title,
        postBody = item.body;

      const div = document.createElement('div');
      div.classList.add('post_item');
      div.setAttribute('id', `${postID}`);

      const title = document.createElement('h2');
      title.classList.add('title');
      title.textContent = postTitle;
      div.insertAdjacentElement('beforeend', title);

      const body = document.createElement('p');
      body.classList.add('body');
      body.textContent = postBody;
      div.insertAdjacentElement('beforeend', body);

      const btn = document.createElement('a');
      btn.classList.add('read_more');
      btn.textContent = 'Read More';
      div.insertAdjacentElement('beforeend', btn);

      postsContainer.insertAdjacentElement('beforeend', div);
    }
  });

  const posts = document.querySelectorAll('.post_item');
  if (posts) {
    posts.forEach((post) => {
      const btn = post.querySelector('.read_more');
      btn.addEventListener('click', () => {
        location.href = `/rest-api/single-post/?id=${post.id}`;
      });
    });
  }
}

fetchPosts();
