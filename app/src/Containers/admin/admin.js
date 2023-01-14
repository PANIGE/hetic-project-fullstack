import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './style.css'

class admin extends Component {
    
    state = {
        post: {}
    }

    componentDidMount() {

        fetch('http://jsonplaceholder.typicode.com/todos/1')
        .then((response) => {
            return response.json()
        })
        .then((result) => {
            this.setState({post: result})
        })

    }
    render() {
        return (
    <div clasName="section">

    <h1>Members</h1>

        <div id='allMember'>
            <div className='cardMember'>

                        <div className='cardMemberContent'>
                            <div>
                                <div>
                                    <p>Nom</p>
                                    <p>email</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                <p>dans la coloc depuis :</p>                                    
                                <p>statut</p>
                                </div>
                            </div> 
                        </div>
                </div>
        </div>
                    
                <NavLink to="/admin/Create" id='createBtn'
                    className= {({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
                >+</NavLink>
                   
                <Outlet />
    </div>
        )
    }
}

export default admin

