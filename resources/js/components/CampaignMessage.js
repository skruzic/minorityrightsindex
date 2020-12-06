import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core';
import LinearProgress from '@material-ui/core/LinearProgress';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import Button from '@material-ui/core/Button';
import { isEmpty } from 'lodash';

const CampaignMessage = ({
    message,
    type,
    classes,
    nextStep,
    previousStep
}) => (
    <>
        <Card className={classes.root}>
            <CardContent dangerouslySetInnerHTML={{ __html: message }} />
            <CardActions className={classes.actions} disableSpacing={true}>
                {type === 'intro' && (
                    <Button
                        variant="contained"
                        color="primary"
                        onClick={nextStep}
                    >
                        Next
                    </Button>
                )}
            </CardActions>
        </Card>
    </>
);

CampaignMessage.propTypes = {
    message: PropTypes.string.isRequired,
    type: PropTypes.oneOf(['intro', 'final']).isRequired
};

const styles = theme => ({
    root: {
        display: 'flex',
        flexDirection: 'column',
        padding: theme.spacing(1)
    },
    actions: {
        display: 'flex',
        flexDirection: 'row-reverse',
        justifyContent: 'space-between'
    }
});

export default withStyles(styles)(CampaignMessage);
