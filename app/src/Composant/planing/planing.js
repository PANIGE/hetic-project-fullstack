import React from 'react'
import { NavLink, Outlet } from 'react-router-dom'

export default function planing() {
    return (
        <div>
            <ul>

                <NavLink to="/planing" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >search</NavLink>
                
                <NavLink to="/planing/Create" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >Create</NavLink>
            
            </ul>
            <Outlet />
        </div>
    )
}
