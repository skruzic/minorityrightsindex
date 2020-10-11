import React from 'react';
import ReactDOM from 'react-dom';
import store from './app/store';
import logger from 'redux-logger';
import { Provider } from 'react-redux';
import { BrowserRouter as Router } from 'react-router-dom';
import ErrorBoundary from './errors/ErrorBoundary';
import App from './containers/App';

ReactDOM.render(
    <Provider store={store}>
        <Router>
            <ErrorBoundary>
                <App />
            </ErrorBoundary>
        </Router>
    </Provider>,
    document.getElementById('root')
);
