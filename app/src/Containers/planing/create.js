import React from 'react'

export default function report() {
    return (
        <div>
            <form action="creat" method="post">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" />
                <label for="commentaire">Commentaire</label>
                <input type="text" name="commentaire" id="commentaire" />
            </form>
        </div>
    )
}
