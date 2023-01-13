import React from 'react'

export default function register() {
    function handleClick(e) {
        e.preventDefault();

        fetch('http://localhost:3000/report/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: 'foo',
                    body: 'bar',
                    userId: 1
                    })
        })
        .then((response) => {
            return response.json()
        })
    }

    return (
        <div>
            <form onSubmit={handleClick}>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" />
                <label for="commentaire">Commentaire</label>
                <input type="text" name="commentaire" id="commentaire" />
                <button id="send" type="submit">Submit</button>
            </form>
        </div>
    )
}
