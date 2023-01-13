import React from 'react'
import { NavLink } from 'react-router-dom'
import './other.css';

export default function Home() {
    return (
        <div>
              <ul className='nav'>
                    <NavLink to="/" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} 
                    >Home</NavLink>
                    
                    <NavLink to="/transaction" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}}
                    >Transaction</NavLink>

                    <NavLink to="/planing" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} 
                    >Planing</NavLink>

                    <NavLink to="/report" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} 
                    >Report</NavLink>
              </ul>
        </div>
    )
}
