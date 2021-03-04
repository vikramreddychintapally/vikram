import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import UserList from './UserList';


export default class App extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">User Details</div>
                            <div className="panel-body">
                                <UserList />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
