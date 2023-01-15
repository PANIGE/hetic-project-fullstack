import React ,{Component} from 'react'
import { NavLink, Outlet } from 'react-router-dom'
import './transaction.css'

class transaction extends Component {
    
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

    <h1>Transaction</h1>

        <div id='allTransaction'>
            <div className='cardTransaction'>

                        <div className='cardTransactionContent'>
                            <div>
                                <div>
                                    <p>emitter</p>
                                    <p>type</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                <p>reason</p>                                    
                                <p>value</p>
                                </div>
                            </div> 
                        </div>
                </div>
        </div>
                    
                <NavLink to="/transaction/Create" id='createBtn'
                    className= {({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
                >+</NavLink>
                   
                <Outlet />
    </div>
        )
    }
}

export default transaction