import React from 'react';
import { Switch, Route } from 'react-router-dom';
import { withStyles } from '@material-ui/core';
import CssBaseline from '@material-ui/core/CssBaseline';
import Container from '@material-ui/core/Container';
import Campaign from './Campaign';
import CampaignFinish from '../components/CampaignFinish';

const App = ({ classes }) => (
    <div className={classes.root}>
        <CssBaseline />
        <Container component="main" className={classes.main} maxWidth="md">
            <Switch>
                <Route path="/" exact component={null} />
                <Route path="/finished" exact component={CampaignFinish} />
                <Route path="/:slug" component={Campaign} />
            </Switch>
        </Container>
    </div>
);

const styles = theme => ({
    root: {
        display: 'flex',
        flexDirection: 'column',
        minHeight: '100vh'
    },
    main: {
        marginTop: theme.spacing(8),
        marginBottom: theme.spacing(2)
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
