import React , {useState} from 'react'
import { NavLink, Outlet } from 'react-router-dom'

export default function Register() {

    const [title, setTitle] = useState('');
    const [comment, setComment] = useState('');
    const [dateMin, setDateMin] = useState('');
    const [dateMax, setDateMax] = useState('');

    const handleTitle = (e) => {

        setTitle(e.target.value);
        
    }
    
    const handleComment = (e) => {

        setComment(e.target.value);

    }

    const handleDateMin = (e) => {

        setDateMin(e.target.value);

    }

    const handleDateMax = (e) => {

        setDateMax(e.target.value);
    
    }


    function handleClick(e) {
        e.preventDefault();

        fetch('Report/New', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: {title},
                    comment: {comment},
                    dateMin: {dateMin},
                    dateMax: {dateMax}
                })
        })
        .then((response) => {
            return response.json()
        })
    }


    return (
        <div className='form'>
            <form onSubmit={handleClick}>
                
                <div className='div_input'>
                    <input type="text" name="title" id="title"  value={title} onChange={handleTitle} required />
                    <span></span>
                    <label for="title">Title</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="commentaire" id="commentaire" value={comment} onChange={handleComment} required />
                    <span></span>
                    <label for="commentaire">Commentaire</label>
                </div>

                <div className='div_input'>
                    <input type="date" name="dateMin" id="dateMin" value={dateMin} onChange={handleDateMin} required />
                    <span></span>
                    <label for="dateMin">date min</label>
                </div>

                <div className='div_input'>
                    <input type="date" name="dateMax" id="dateMax"  value={dateMax} onChange={handleDateMax} required />
                    <span></span>
                    <label for="dateMin">date max</label>
                </div>
                
                <input type="submit" id="send" value="Submit"/>
                
            </form>

            <NavLink to="/report/" id='searchBtn'
                className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
            >-</NavLink>
                    
        </div>
    )
    
    
}
