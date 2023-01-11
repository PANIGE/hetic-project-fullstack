import React from 'react'
import { NavLink, Outlet } from 'react-router-dom'

export default function report() {
    return (
        <div>
            <ul>

                <NavLink to="/report" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >search</NavLink>
                
                <NavLink to="/report/Create" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >Create</NavLink>
            
            </ul>
            <Outlet />
        </div>
    )
}
