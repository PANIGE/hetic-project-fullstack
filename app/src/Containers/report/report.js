import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './style.css'

class report extends Component {
    
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
            <div className='section'>

                <h1>Report</h1>
                
                <div id='allPlaning'>
                    <div className='card'>
                        <h4>{this.state.post.title} | by  </h4>
                        <div className='cardContent'>
                            <div>
                                <p>Planing Commentaire</p>
                                <div>
                                    <p>date start</p>
                                    <p>date end</p>
                                </div>
                            </div>
                            <div>
                                <h4>transation €</h4>
                                <p>type</p>
                            </div> 
                        </div>
                    </div>
                </div>

                <NavLink to="/report/Create" id='createBtn'
                    className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
                >+</NavLink>
                
                <Outlet />
            </div>
        )
    }
}

export default report