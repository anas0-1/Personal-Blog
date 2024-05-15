function showSection(sectionId) {
    // Hide all sections

    document.querySelectorAll('main section').forEach(section => {
        console.log('sectionID : '+section.id)
        section.style.display = 'none';
    });
    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';
    console.log(showSection);
   
}


