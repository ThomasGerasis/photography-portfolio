// book-now-button.js
// Book Now Button shortcode config for dynamic modal

export const bookNowButtonConfig = {
    shortcode: 'book_now_button',
    title: 'Insert Book Now Button',
    formHtml: `
      <form id="bookNowButtonForm">
        <div class="form-group">
          <label for="type">Button Type</label>
          <select class="form-control" id="type" name="type">
            <option value="single">Single Button</option>
            <option value="dropdown">Dropdown Selector</option>
          </select>
        </div>
        <div class="form-group">
          <label for="package_id">Package ID (0, 1, 2...)</label>
          <input type="text" class="form-control" id="package_id" name="package_id" />
        </div>
        <div class="form-group">
          <label for="page_id">Page ID (for dropdown)</label>
          <input type="text" class="form-control" id="page_id" name="page_id" />
        </div>
        <div class="form-group">
          <label for="text">Button Text</label>
          <input type="text" class="form-control" id="text" name="text" value="Book Now" />
        </div>
        <div class="form-group">
          <label for="align">Alignment</label>
          <select class="form-control" id="align" name="align">
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
          </select>
        </div>
        <div class="form-group">
          <label for="class">CSS Class</label>
          <input type="text" class="form-control" id="class" name="class" value="alime-btn bg-secondary" />
        </div>
        <div class="form-group">
          <label for="target">Target (anchor)</label>
          <input type="text" class="form-control" id="target" name="target" value="#contactForm" />
        </div>
      </form>`
};
