// why-choose-me.js
// Why Choose Me shortcode config for dynamic modal

export const whyChooseMeConfig = {
    shortcode: 'why_choose_me',
    title: 'Insert Why Choose Me Section',
    formHtml: `
      <form id="whyChooseMeForm">
        <div class="form-group">
          <label for="page_id">Page ID (optional)</label>
          <input type="text" class="form-control" id="page_id" name="page_id" />
        </div>
        <div class="form-group">
          <label for="category_id">Category ID (optional)</label>
          <input type="text" class="form-control" id="category_id" name="category_id" />
        </div>
        <div class="form-group">
          <label for="title">Section Title</label>
          <input type="text" class="form-control" id="title" name="title" value="Why Choose Me" />
        </div>
      </form>`
};
