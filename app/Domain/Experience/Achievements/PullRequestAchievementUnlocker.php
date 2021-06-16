<?php

namespace App\Domain\Experience\Achievements;

use App\Domain\Experience\Projections\UserAchievementProjection;
use App\Domain\Experience\ValueObjects\UserExperienceId;

class PullRequestAchievementUnlocker
{
    /**
     * @return \App\Domain\Experience\Achievements\PullRequestAchievement[]
     */
    private function getAchievements(): array
    {
        return [
            new PullRequestAchievement('10-pull-requests', '10 Pull Requests', "You've got ten merged pull requests!", 10),
            new PullRequestAchievement('50-pull-requests', '50 Pull Requests', "You've got fifty merged pull requests!", 50),
            new PullRequestAchievement('100-pull-requests', '100 Pull Requests', "You've got a hundred merged pull requests!", 100),
            new PullRequestAchievement('200-pull-requests', '200 Pull Requests', "You've got two hundred merged pull requests!", 200),
        ];
    }

    public function achievementToBeUnlocked(
        int $pullRequestCount,
        UserExperienceId $userExperienceId
    ): ?PullRequestAchievement {
        foreach ($this->getAchievements() as $achievement) {
            if (UserAchievementProjection::forUser($userExperienceId)->andSlug($achievement->slug)->exists()) {
                continue;
            }

            if (! $achievement->matches($pullRequestCount)) {
                continue;
            }

            return $achievement;
        }

        return null;
    }
}
