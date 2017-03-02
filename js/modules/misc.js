/**
 * Open/Close Modal
 */
(function() {
    var overlay = $('#modalOverlay');
    var modal = $('#modal');
    
    // Open Modal
    $('.js-openModal').click(function() {
        overlay.fadeIn();
        modal.addClass('open');
    });
    
    // Close Modal
    function closeModal() {
        overlay.fadeOut();
        modal.removeClass('open');
    };
    
    $('.js-closeModal').click(closeModal);
    overlay.click(closeModal);
})();