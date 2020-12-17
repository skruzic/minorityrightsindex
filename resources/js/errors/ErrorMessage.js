import React from 'react';
import { withStyles } from '@material-ui/core';
import CampaignHeader from '../components/CampaignHeader';
import Typography from '@material-ui/core/Typography';

const ErrorMessage = ({ message, classes }) => {
    return (
        <div className={classes.root}>
            <CampaignHeader title="Error" />
            <Typography variant="body1" className={classes.text}>
                {message}
            </Typography>
        </div>
    );
};

const styles = theme => ({
    root: {
        margin: theme.spacing(3)
    },
    text: {
        padding: theme.spacing(2)
    }
});

export default withStyles(styles, { withTheme: true })(ErrorMessage);
