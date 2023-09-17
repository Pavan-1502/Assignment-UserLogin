document.addEventListener("DOMContentLoaded", async function () {
    const joinButton = document.getElementById("joinButton");
    const modal = document.getElementById("myModal");
    const popupMessageElement = document.getElementById("popupMessage");

    
    function openModal() {
        modal.style.display = "block";
        
    }

    
    function closeModal() {
        modal.style.display = "none";
    }

    joinButton.addEventListener("click", async function (event) {
        try {
            event.preventDefault(); 

            const creditsInput = document.getElementById("credits");
            const selectedCredits = creditsInput.value;

            
            const formData = new FormData();
            formData.append("credits", selectedCredits);

            const response = await fetch("payment.php", {
                method: "POST",
                body: formData,
            });

            if (response.ok) {
                const responseText = await response.text();

                if (responseText.trim() === "success") {
                    
                    openModal();
                    creditsInput.value = "";
                    //window.location.href = "class.html";
                }
                else
                {
                    openModal("Purchase failed: " + responseText);
                }
            } 
            else 
            {
                openModal("Purchase request failed");
            }
        } catch (error) {
            console.error(error);
            openModal("An error occurred: " + error.message);
        }
    });

    
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });
    closeModalButton.addEventListener("click", closeModal);
});