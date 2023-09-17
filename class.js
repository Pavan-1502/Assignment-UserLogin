document.addEventListener("DOMContentLoaded", async function () {
    const joinButton = document.getElementById("joinButton");
    const modal = document.getElementById("myModal");
    const insufficientModal = document.getElementById("insufficientModal");
    const navigateButton = document.getElementById("navigateButton");

    // to open the main modal
    function openModal() {
        modal.style.display = "block";
    }

    // to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // to open the insufficient credits modal
    function openInsufficientModal() {
        insufficientModal.style.display = "block";
    }

    // to close the insufficient credits modal
    function closeInsufficientModal() {
        insufficientModal.style.display = "none";
    }

    
    joinButton.addEventListener("click", async function (event) {
        try {
           
            event.preventDefault();

            // fetch user's credits from the backend
            const response = await fetch("backend.php", {
                method: "GET",
            });

            if (response.ok) {
                const data = await response.json();
                const credits = data.credits;

                if (credits > 0) {
                
                    const updatedCredits = credits - 1;

                    
                    const updateResponse = await fetch("backend.php", {
                        method: "POST",
                    });

                    if (updateResponse.ok) {
                        
                        openModal();
                    } else {
                        
                        console.error("Failed to update credits.");
                    }
                } 
                else 
                {
                    
                    openInsufficientModal();
                }
            } 
            else 
            {
                
                console.error("Failed to fetch user's credits.");
            }
        } 
        catch (error) {
            
            console.error(error);
        }
    });

    // Close the main modal when the close button is clicked
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close the insufficient credits modal when the close button is clicked
    insufficientModal.addEventListener("click", function (event) {
        if (event.target === insufficientModal) {
            closeInsufficientModal();
        }
    });

    // Navigate to the payment page when the "Go to Payment Page" button is clicked
    navigateButton.addEventListener("click", function () {
        window.location.href = "payment.html";
    });

    closeModalButton.addEventListener("click", closeModal);
});




























































































// document.addEventListener("DOMContentLoaded", async function () {
//     const joinButton = document.getElementById("joinButton");

//     // Add a click event listener to the button
//     joinButton.addEventListener("click", async function (event) {
//         try {
//             // Prevent the default form submission behavior
//             event.preventDefault();

//             // Fetch user's credits from the backend
//             const response = await fetch("backend.php", {
//                 method: "GET",
//             });

//             if (response.ok) {
//                 const data = await response.json();
//                 const credits = data.credits;

//                 if (credits > 0) {
//                     // Deduct 1 credit
//                     const updatedCredits = credits - 1;

//                     // Update credits in the backend
//                     const updateResponse = await fetch("backend.php", {
//                         method: "POST",
//                     });

//                     if (updateResponse.ok) {
//                         // Display "Class Joined" alert without navigation
//                         alert("Class Joined");

                        
//                         return false;
//                     } else {
//                         alert("Failed to update credits.");
//                     }
//                 } else {
//                     // Display "Insufficient credits" alert without navigation
//                     alert("Insufficient credits.");
//                     window.location.href = "payment.html";
//                     return false; // Return false to prevent the form from submitting
//                 }
//             } else {
//                 alert("Failed to fetch user's credits.");
//             }
//         } catch (error) {
//             console.error(error);

//             alert("An error occurred: " + error.message);
//         }
//     });
// });



