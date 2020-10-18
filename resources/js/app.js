import React from 'react';
import ReactDOM from 'react-dom';
import store from './app/store';
import { Provider } from 'react-redux';
import { BrowserRouter as Router } from 'react-router-dom';
import { ThemeProvider } from '@material-ui/core/styles';
import theme from './app/theme';
import ErrorBoundary from './errors/ErrorBoundary';
import App from './containers/App';

ReactDOM.render(
    <Provider store={store}>
        <ThemeProvider theme={theme}>
            <Router>
                <ErrorBoundary>
                    <App />
                </ErrorBoundary>
            </Router>
        </ThemeProvider>
    </Provider>,
    document.getElementById('root')
);
