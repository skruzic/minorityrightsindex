import React from 'react';
import ReactDOM from 'react-dom';
import store from './app/store';
import logger from 'redux-logger';
import { Provider } from 'react-redux';
import { BrowserRouter as Router } from 'react-router-dom';
import App from './containers/App';

ReactDOM.render(
    <Provider store={store}>
        <Router>
            <App />
        </Router>
    </Provider>,
    document.getElementById('root')
);
