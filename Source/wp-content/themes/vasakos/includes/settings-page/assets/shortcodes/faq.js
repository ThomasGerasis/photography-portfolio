// faq.js
// FAQ shortcode config for dynamic modal

export const faqConfig = {
    shortcode: 'faq',
    title: 'Insert FAQ',
    formHtml: `
      <form id="faqForm">
        <div class="form-group">
          <label for="page_id">Page ID (optional)</label>
          <input type="text" class="form-control" id="page_id" name="page_id" />
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="Frequently Asked Questions" />
        </div>
        <div class="form-group">
          <label for="subtitle">Subtitle</label>
          <input type="text" class="form-control" id="subtitle" name="subtitle" value="What people ask" />
        </div>
      </form>`
};
