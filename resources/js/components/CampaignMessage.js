import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import Button from '@material-ui/core/Button';
import ProgressWithLabel from './ProgressWithLabel';

const CampaignMessage = ({
    message,
    type,
    nextStep,
    currentStep,
    totalSteps,
    invite,
    saveFn,
    updateStatus
}) => (
    <>
        <ProgressWithLabel
            value={((currentStep - 1) / (totalSteps - 1)) * 100}
        />
        <Card>
            <CardContent dangerouslySetInnerHTML={{ __html: message }} />
            {type === 'intro' && (
                <CardActions disableSpacing={true}>
                    <Button
                        variant="contained"
                        color="primary"
                        onClick={() => {
                            nextStep();
                            !!saveFn &&
                                saveFn({
                                    invite_id: invite.id,
                                    page: currentStep
                                });
                            updateStatus({
                                invite_id: invite.id,
                                page: currentStep,
                                direction: 1
                            });
                        }}
                    >
                        Next
                    </Button>
                </CardActions>
            )}
        </Card>
    </>
);

CampaignMessage.propTypes = {
    message: PropTypes.string.isRequired,
    type: PropTypes.oneOf(['intro', 'final']).isRequired,
    saveFn: PropTypes.func.isRequired
};

const mapStateToProps = state => {
    return {
        invite: state.invite.data
    };
};

export default connect(mapStateToProps)(CampaignMessage);
