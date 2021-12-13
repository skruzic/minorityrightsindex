import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { withStyles } from '@material-ui/core';
import { withRouter } from 'react-router-dom';
import { compose } from 'redux';
import { Field, formValueSelector } from 'redux-form';
import Card from '@material-ui/core/Card';
import CardActions from '@material-ui/core/CardActions';
import TextQuestion from '../components/TextQuestion';
import RadioQuestion from '../components/RadioQuestion';
import CheckboxQuestion from '../components/CheckboxQuestion';
import Button from '@material-ui/core/Button';
import { isEmpty } from 'lodash';
import LikertQuestion from '../components/LikertQuestion';
import ProgressWithLabel from '../components/ProgressWithLabel';
import {
    saveCampaignAnswers,
    updateVisitedPages
} from '../slices/campaignsSlice';
import { updateInvite } from '../slices/inviteSlice';

const Question = ({
    question,
    classes,
    nextStep,
    previousStep,
    goToStep,
    currentStep,
    totalSteps,
    conditionalJumps,
    value,
    invite,
    saveResponse,
    history,
    saveFn,
    visitedPages,
    visitedPagesPreview,
    updateStatus,
    preview,
    updateVisitedPages,
    updateInvite,
    saveCampaignAnswers
}) => {
    const renderQuestion = question => {
        switch (question.type) {
            case 0:
            case 1:
                return (
                    <Field
                        key={question.id}
                        component={TextQuestion}
                        name={question.code}
                        text={question.text}
                        questionType={question.type}
                    />
                );
            case 2:
                return (
                    <Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 3:
                return (
                    <Field
                        key={question.id}
                        component={CheckboxQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 4:
                return (
                    <LikertQuestion
                        key={question.id}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                        questions={question.children}
                        invite={invite}
                        currentStep={currentStep}
                        saveFn={saveFn}
                    />
                );
            case 5:
                return null;
            default:
                return null;
        }
    };

    const handleSave = () => {
        // Ne piši ništa ako pitanje ima children pitanja (Likert)
        /*question.type !== 4 &&
            !!saveFn &&
            saveFn({
                invite_id: invite.id,
                question_id: question.id,
                answer: value,
                //page: currentStep + 1
                page: currentStep
            });*/

        !preview &&
            question.type !== 4 &&
            saveCampaignAnswers({
                invite_id: invite.id,
                question_id: question.id,
                answer: value,
                //page: currentStep + 1
                page: currentStep
            });
    };

    const handleNext = (jump = 1) => {
        !preview &&
            updateInvite({
                invite_id: invite.id,
                page: currentStep,
                jump,
                direction: 1
            });

        preview &&
            updateVisitedPages({
                direction: 1,
                value: currentStep
            });
    };

    const handlePrev = () => {
        !preview &&
            updateInvite({
                invite_id: invite.id,
                page: currentStep,
                jump: 1,
                direction: -1
            });

        preview &&
            updateVisitedPages({
                direction: -1,
                value: currentStep
            });
    };

    const computeJump = () => {
        const matchIdx = question.conditions.findIndex(
            item => parseInt(item.answer) === parseInt(value)
        );

        return conditionalJumps[matchIdx];
    };

    return (
        <>
            <ProgressWithLabel
                value={((currentStep - 1) / (totalSteps - 1)) * 100}
            />
            <Card className={classes.root}>
                {renderQuestion(question)}
                <CardActions className={classes.actions} disableSpacing={true}>
                    {currentStep < totalSteps - 1 && (
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                const jump = computeJump();

                                if (isEmpty(question.conditions)) {
                                    nextStep();
                                    handleNext();
                                } else if (jump > -1) {
                                    // +2 zbog uvodne stranice i zero-indexiranja
                                    goToStep(jump + 2);
                                    handleNext(jump + 2);
                                } else {
                                    nextStep();
                                    handleNext();
                                }

                                handleSave();
                            }}
                        >
                            Next
                        </Button>
                    )}
                    {currentStep === totalSteps - 1 && (
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                handleSave();
                                nextStep();
                            }}
                        >
                            Finish
                        </Button>
                    )}
                    {currentStep !== 1 && (
                        <Button
                            variant="contained"
                            color="primary"
                            onClick={() => {
                                if (!preview) {
                                    const currentIndex = visitedPages.indexOf(
                                        currentStep
                                    );

                                    if (currentIndex < 0) {
                                        goToStep(
                                            visitedPages[
                                                visitedPages.length - 1
                                            ]
                                        );
                                    } else {
                                        goToStep(
                                            visitedPages[currentIndex - 1]
                                        );
                                    }
                                } else {
                                    const currentIndex = visitedPagesPreview.indexOf(
                                        currentStep
                                    );

                                    if (currentIndex < 0) {
                                        goToStep(
                                            visitedPagesPreview[
                                                visitedPagesPreview.length - 1
                                            ]
                                        );
                                    } else {
                                        goToStep(
                                            visitedPagesPreview[
                                                currentIndex - 1
                                            ]
                                        );
                                    }
                                }
                                handlePrev();
                            }}
                        >
                            Back
                        </Button>
                    )}
                </CardActions>
            </Card>
        </>
    );
};

Question.propTypes = {
    question: PropTypes.object.isRequired
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

const selector = formValueSelector('campaignForm');

const mapStateToProps = (state, ownProps) => {
    return {
        value: selector(state, ownProps.question.code),
        invite: state.invite.data,
        preview: state.campaign.preview,
        visitedPages: state.invite.data.visitedPages,
        visitedPagesPreview: state.campaign.visitedPages
    };
};

export default compose(
    connect(mapStateToProps, {
        saveCampaignAnswers,
        updateInvite,
        updateVisitedPages
    }),
    withStyles(styles, { withTheme: true }),
    withRouter
)(Question);
