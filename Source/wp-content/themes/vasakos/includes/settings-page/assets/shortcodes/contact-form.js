// contact-form.js
// Handles Contact Form shortcode logic and Bootstrap modal

export function registerContactForm(editor) {
    editor.addMenuItem('contact_form', {
        text: 'Contact Form',
        onclick: () => showContactFormModal(editor)
    });
}

export function showContactFormModal(editor) {
    // Insert Bootstrap modal HTML into DOM if not present
    if (!document.getElementById('contactFormModal')) {
        const modalHtml = `
        <div class="modal fade" id="contactFormModal" tabindex="-1" role="dialog" aria-labelledby="contactFormModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="contactFormModalLabel">Insert Contact Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="contactFormModalForm">
                  <div class="form-group">
                    <label for="show_packages">Show Package Selector</label>
                    <select class="form-control" id="show_packages" name="show_packages">
                      <option value="no">No</option>
                      <option value="yes">Yes</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="page_id">Page ID (optional)</label>
                    <input type="text" class="form-control" id="page_id" name="page_id" />
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="contactFormModalInsert">Insert</button>
              </div>
            </div>
          </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }

    // Show modal
    $('#contactFormModal').modal('show');

    // Insert handler
    document.getElementById('contactFormModalInsert').onclick = function() {
        const showPackages = document.getElementById('show_packages').value;
        const pageId = document.getElementById('page_id').value;
        let shortcode = '[contact_form';
        if (showPackages !== 'no') {
            shortcode += ' show_packages="' + showPackages + '"';
        }
        if (pageId) {
            shortcode += ' page_id="' + pageId + '"';
        }
        shortcode += ']';
        editor.insertContent(shortcode);
        $('#contactFormModal').modal('hide');
    };
}
