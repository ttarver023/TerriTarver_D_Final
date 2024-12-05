document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const responseMessage = document.getElementById("responseMessage");
    const submitButton = document.getElementById("submitButton");

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        submitButton.value = 'Submitting...';
        submitButton.disabled = true; 

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        // const formData = new FormData(contactForm);
        const formData = {
            name: name,
            email: email,
            subject: subject,
            message: message,
        };

        const apiEndpoint = window.location.hostname === "localhost" ? "http://localhost:3000/api/contact" : "https://backend-app-8ev9.onrender.com/api/contact";

        fetch(apiEndpoint, {
            method: "POST",
            headers: {
                'Content-Type':
                    'application/json;charset=utf-8'
            },
            body: JSON.stringify(formData)
        })
            .then(response => response.json())
            .then(data => {
                submitButton.value = 'Submit';
                submitButton.disabled = false; // Re-enable the button
                responseMessage.innerHTML = `<p>${data.message}</p>`;
                responseMessage.classList.add("success", "show"); 

                setTimeout(() => {
                    contactForm.reset();
                    responseMessage.innerHTML = "";
                    responseMessage.classList.remove("success", "show");
                }, 2000);
            })
            .catch(error => {
                console.error("Error:", error);
                submitButton.value = 'Submit';
                submitButton.disabled = false; // Re-enable the button
                responseMessage.innerHTML = `<p>Error submitting the form. Please try again later.</p>`;
                responseMessage.classList.add("error", "show"); 

                setTimeout(() => {
                    responseMessage.innerHTML = "";
                    responseMessage.classList.remove("error", "show");
                }, 3000);
            });
    });
});