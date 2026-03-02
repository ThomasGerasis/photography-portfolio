// shortcode-modal.js
// Handles a single Bootstrap modal for all shortcodes

export function showShortcodeModal(editor, shortcodeConfig) {
    // Insert modal HTML if not present
    if (!document.getElementById('shortcodeModal')) {
        const modalHtml = `
        <div class="modal fade" id="shortcodeModal" tabindex="-1" role="dialog" aria-labelledby="shortcodeModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="shortcodeModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="shortcodeModalBody">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="shortcodeModalInsert">Insert</button>
              </div>
            </div>
          </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }

    // Set modal title and body
    document.getElementById('shortcodeModalLabel').textContent = shortcodeConfig.title;
    document.getElementById('shortcodeModalBody').innerHTML = shortcodeConfig.formHtml;

    // Show modal
    $('#shortcodeModal').modal('show');

    // Insert handler
    document.getElementById('shortcodeModalInsert').onclick = function() {
        const form = document.getElementById('shortcodeModalBody').querySelector('form');
        const formData = new FormData(form);
        let shortcode = '[' + shortcodeConfig.shortcode;
        for (const [key, value] of formData.entries()) {
            if (value) {
                shortcode += ' ' + key + '="' + value + '"';
            }
        }
        shortcode += ']';
        editor.insertContent(shortcode);
        $('#shortcodeModal').modal('hide');
    };
}
