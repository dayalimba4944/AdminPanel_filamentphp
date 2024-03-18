<script>
    
var mediaTypesElement = document.getElementById('data.media_types');
// console.log(mediaTypesElement);

function mediaElementFaction() {
    var mediaElement = document.getElementsByClassName('filepond--browser')[0];
    var dropLabels = document.querySelector('[for="data.media"]').children;
    var  mediaErrorElement = dropLabels[0].children[0];
    mediaErrorElement.innerText = "* please select media type before upload the file";


    if (mediaElement) {
        mediaElement.type = 'text';
    } else {
        console.error('FilePond input element not found.');
    }
}

// Call mediaElementFaction function after a timeout of 10 seconds
setTimeout(mediaElementFaction, 3000);


// window.onload = function(e){ 
//     var mediaElement = document.getElementsByClassName('filepond--browser')[0];
//     mediaElement.type = 'text';
// }


    mediaTypesElement.addEventListener('change', function(event) {

        

        var mediaPreview = document.getElementsByClassName('filepond--list-scroller')[0];
        // mediaPreview.children[0].innerHTML = null;


        var mediaElement = document.getElementsByClassName('filepond--browser')[0];
        var mediaColom = document.getElementById('data.media');
        var dropLabels = document.querySelector('.filepond--drop-label');

        var childrenOfDropLabels = dropLabels.children;

        console.log(childrenOfDropLabels[0]);
        mediaElement.type = 'text';
        // childrenOfDropLabels[0].style.display = 'none'; 
        // mediaTypes.style.color = 'red'; 

        var dropLabels = document.querySelector('[for="data.media"]').children;
        var  mediaErrorElement = dropLabels[0].children[0];
   

        var mediaTypes = event.target.value;
        if (mediaTypes === 'image') {
            console.log(mediaTypes);
            if (mediaElement) {
                mediaErrorElement.innerText = "*";
                mediaElement.type = 'file';
                mediaElement.setAttribute('accept', 'image/*');
            } else {
                console.error('FilePond input element not found.');
            }
        } else if (mediaTypes === 'video') {
            console.log(mediaTypes);
            mediaErrorElement.innerText = "*";
            mediaElement.type = 'file';
            mediaElement.setAttribute('accept', 'video/*');
        } else {
            console.log(mediaTypes); 
            mediaErrorElement.innerText = "* please select media type before upload the file";  
            mediaElement.type = 'text';
            mediaElement.setAttribute('accept', '');
            
            // console.log('mediaColom :-'+ mediaColom);
            // console.log( mediaColom);
            // if (mediaTypes) {
            //     mediaTypes.style.display = 'none'; // Hide the media column
            // }
        }
    });

// var dropLabels = document.querySelector('.filepond--drop-label');

// console.log(dropLabels);

// // setTimeout(dropLabels, 10000);
// window.onload = function(e){ 
//     console.log("window.onload", e, dropLabels ?? 'hi');
// }


// document.addEventListener('DOMContentLoaded', function () {
//     var mediaElement = document.getElementById('media');
//     mediaElement.disabled = true; 
// });



// document.addEventListener('DOMContentLoaded', function () {
//                 var mediaTypesElement = document.getElementById('media_types');
//                 var mediaElement = document.getElementById('media');

//                 mediaTypesElement.addEventListener('change', function(event) {
//                     var mediaTypes = event.target.value;
//                     if (mediaTypes === 'image' || mediaTypes === 'video') {
//                         mediaElement.disabled = false; // Enable media upload field
//                     } else {
//                         mediaElement.disabled = true; // Disable media upload field
//                     }
//                 });
//             });

// if (dropLabels) {
//     // Get the children of the dropLabels element
//     var childrenOfDropLabels = dropLabels.children;

//     // Check if children exist before attempting to remove the 'for' attribute
//     if (childrenOfDropLabels.length > 0) {
//         // Loop through the children and remove the 'for' attribute if it exists
//         for (var i = 0; i < childrenOfDropLabels.length; i++) {
//             childrenOfDropLabels[i].removeAttribute('for');
//         }
//     } else {
//         console.error('Children of drop labels element not found.');
//     }
// } else {
//     console.error('Drop labels element not found.');
// }








    //  document.addEventListener('DOMContentLoaded', function () {
    //             var mediaTypesElement = document.getElementById('media_types');
    //             var mediaElement = document.getElementById('media');

    //             mediaTypesElement.addEventListener('change', function(event) {
    //                 var mediaTypes = event.target.value;
    //                 if (mediaTypes === 'image' || mediaTypes === 'video') {
    //                     mediaElement.disabled = false; // Enable media upload field
    //                 } else {
    //                     mediaElement.disabled = true; // Disable media upload field
    //                 }
    //             });
    //         });

    </script>