import React from 'react';
import { withStyles } from '@material-ui/core';
import Typography from '@material-ui/core/Typography';

const CampaignHeader = ({ title, classes }) => (
    <header className={classes.root}>
        <Typography variant="h2">{title}</Typography>
    </header>
);

const styles = theme => ({
    root: {
        padding: theme.spacing(2)
    }
});

export default withStyles(styles)(CampaignHeader);
