import React from 'react'
import { NavLink } from 'react-router-dom'

export default function Home() {
    return (
        <div>
              <ul className='nav'>
                    <NavLink to="/" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} id="navlink"
                    >Home</NavLink>
                    
                    <NavLink to="/transaction" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}}
                    >transaction</NavLink>

                    <NavLink to="/planing" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} id="navlink"
                    >Planing</NavLink>

                    <NavLink to="/report" 
                        className={({isActive}) => { return isActive ? "activeLink" : ""}} id="navlink"
                    >Report</NavLink>
              </ul>
        </div>
    )
}
