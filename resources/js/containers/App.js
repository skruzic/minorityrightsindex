import React from 'react';
import { withStyles } from '@material-ui/core';
import Campaign from './Campaign';

const App = ({ classes }) => (
    <div className={classes.root}>
        <main className={classes.content}>
            <Campaign />
        </main>
    </div>
);

const styles = theme => ({
    root: {
        display: 'flex'
    },
    content: {
        flexGrow: 1,
        maxWidth: theme.breakpoints.values.lg,
        //height: '100vh',
        overflow: 'auto',
        padding: theme.spacing(3)
    }
});

export default withStyles(styles, { withTheme: true })(App);
