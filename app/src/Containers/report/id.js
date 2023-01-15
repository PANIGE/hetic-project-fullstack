import React from 'react'
import { NavLink , useParams } from 'react-router-dom'
import './style.css'

export default function Report() {

    const { id } = useParams();


    return (
        <div className='idCard'>
            
            <div className='card'>
                <div className='cardTitle'>
                    <h4> {id} | by  </h4>
                    <p>type</p>
                </div>

                <div className='cardContent'>
                    <div>
                        <p>Planing Commentaire</p>
                        <div>
                            <p>date start</p>
                            <p>date end</p>
                        </div>
                    </div>
                    <div>
                        <h4>transaction €</h4>
                    </div> 
                </div>

                <NavLink to="/planing/" id='searchBtn'
                    className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
                >-</NavLink>

            </div>
            
        </div>
    )
}
