

// Set up Dragula containers
var leftContainer = document.getElementById('dragula-left');
var rightContainer = document.getElementById('dragula-right');

var drake = dragula([leftContainer, rightContainer], {
    copy: function (el, source) {
        // Return true to copy the dragged element instead of moving it
        return source === leftContainer;
    },

    accepts: function (el, target) {
        return target !== leftContainer
    }
    ,
    dragulaDecorator: function (el, source) {
        // Add a class to the dragged element for visual feedback
        el.classList.add('is-dragging');
    },
    dragulaEvents: {
        drag: function (el, source, handle) {
            console.log("drag");
            // Prevent the default dragover behavior to avoid page scrolling
            document.body.addEventListener('dragover', preventDefaultDragover);
        },

        dragend: function (el) {
            console.log("dragged");
            // Remove the added class and event listener after the drag ends
            el.classList.remove('is-dragging');
            document.body.removeEventListener('dragover', preventDefaultDragover);
            // Clear any potential drop area highlighting
            clearDropAreaHighlight();
        },

        beforeDrop: function (el, target, source, sibling) {


            // Modify the content of the dragged element before drop
            modifyContentBeforeDrop(el);
        }

    }
});

// Handle drop event
drake.on('drop', function (el, target, source, sibling) {
    // Check if the drop occurred on the right container
    if (target && target.id === 'dragula-right') {
        // Perform actions related to the right container
        // Get the data-time_seconds from the dropped element

        var item_type = $(el).data('type');
        if(item_type =="Pattern" && source.id ==  'dragula-left'){
            console.log("111");
            drake.cancel(true);
            $("#pattern_Minutes").val('0');
            $("#pattern_Seconds").val('0');
            $("#pattern_modal").modal('show');
        }
        else if(item_type =="Macros"){
            drake.cancel(true);
            $("#no-cpl-selected").modal('show');
        }
        else{
            var timeSeconds = $(el).data('time_seconds');
            console.log('Dropped on right with time_seconds:', timeSeconds);
            modifyContentBeforeDrop(el);

            var items =  $('#dragula-right').find('.left-side-item');
            var startTime = 0;

            for (var i = 0; i < items.length; i++) {

                var duration = parseInt(items[i].getAttribute('data-time_seconds'));

                items[i].setAttribute('data-starttime',   formatTime(startTime));
                var composition_start_time=   items[i].getAttribute('data-starttime');

                items[i].querySelector('.mb-0.text-muted.float-left').innerText = formatTime(startTime);
                startTime += duration;
                var composition_end_time=   startTime;
            }
        }

        // You can reorder the items on the left based on the drop
        // For example, you might want to re-render the left container
        // with the updated order after each drop.
       // reorderLeftContainer();
    }
});

// Handle dragover event on containers for highlighting drop area
leftContainer.addEventListener('dragover', highlightDropArea);
rightContainer.addEventListener('dragover', highlightDropArea);

// Function to highlight the drop area
function highlightDropArea(event) {
    event.preventDefault();
    // Add a class to the potential drop area for visual feedback
    event.currentTarget.classList.add('drag-over');
}

// Function to clear drop area highlighting
function clearDropAreaHighlight() {
    // Remove the class from all potential drop areas
    leftContainer.classList.remove('drag-over');
    rightContainer.classList.remove('drag-over');
}

// Function to prevent the default dragover behavior
function preventDefaultDragover(event) {
    event.preventDefault();
}

// Function to modify content before drop
function modifyContentBeforeDrop(el) {

    // Find and modify the content within the dragged element
    var floatLeftElement = el.querySelector('.mb-0.text-muted.float-left');

    // Remove the child element with class 'detail-cpl'
    var detailCplElement = floatLeftElement.querySelector('.detail-cpl');
    if (detailCplElement) {
        floatLeftElement.removeChild(detailCplElement);
    }

    var floatRightElement = el.querySelector('.mb-0.text-muted.float-right');

    // Remove existing content
    floatRightElement.innerHTML = '';

    // Add new content
    floatRightElement.innerHTML = `
        <span class=" ">
            <i class="btn btn-primary  mdi mdi-magnify custom-search  cpl-details" data-uuid="`+el.getAttribute('data-id')+`" data-need_kdm="`+el.getAttribute('data-need_kdm')+`"></i>
            <i class="btn btn-danger mdi mdi-delete-forever remove-cpl custom-search"></i>
        </span>`;



}
