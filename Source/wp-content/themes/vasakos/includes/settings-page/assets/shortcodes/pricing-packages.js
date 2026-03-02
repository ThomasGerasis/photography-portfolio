// pricing-packages.js
// Pricing Packages shortcode config for dynamic modal

export const pricingPackagesConfig = {
    shortcode: 'pricing_packages',
    title: 'Insert Pricing Packages',
    formHtml: `
      <form id="pricingPackagesForm">
        <div class="form-group">
          <label for="page_id">Page ID (optional)</label>
          <input type="text" class="form-control" id="page_id" name="page_id" />
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="Pricing - Packages" />
        </div>
        <div class="form-group">
          <label for="subtitle">Subtitle</label>
          <input type="text" class="form-control" id="subtitle" name="subtitle" value="Choose the perfect package for you" />
        </div>
        <div class="form-group">
          <label for="show_book_button">Show Book Button</label>
          <select class="form-control" id="show_book_button" name="show_book_button">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>
      </form>`
};
