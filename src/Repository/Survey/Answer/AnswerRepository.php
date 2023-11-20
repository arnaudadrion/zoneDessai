<?php

namespace App\Repository\Survey\Answer;

use App\Entity\Project\Project;
use App\Entity\Survey\Answer\Answer;
use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Survey;
use App\Entity\User\User;
use App\Enum\SurveyWistartEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function countTotalWistartAnswers() {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->innerJoin('a.question', 'q')
            ->innerJoin('q.survey', 's');

        $qb
            ->where($qb->expr()->in('s.slug', ':wistartSlugs'))
            ->setParameter('wistartSlugs', SurveyWistartEnum::getWistartSurveys());

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    public function findByUserAndSurvey(User $user, Survey $survey)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin(User::class, 'u', 'WITH', 'a.user = u.id AND u.id = :user')
            ->innerJoin(AbstractQuestion::class, 'q', 'WITH', 'a.question = q.id')
            ->innerJoin(Survey::class, 's', 'WITH', 'q.survey = s.id AND s.id = :survey')
            ->setParameter('user', $user)
            ->setParameter('survey', $survey);

        return $qb->getQuery()->getResult();
    }

    public function findTotalAnswers(User $user, Survey $survey)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->innerJoin(User::class, 'u', 'WITH', 'a.user = u.id AND u.id = :user')
            ->innerJoin(Survey::class, 's', 'WITH', 's.id = :survey')
            ->innerJoin(AbstractQuestion::class, 'q', 'WITH', 'a.question = q.id AND q.survey = s.id')
            ->setParameter('user', $user)
            ->setParameter('survey', $survey);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    public function findByProjectAndSurvey(Project $project, Survey $survey)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.project', 'p')
            ->innerJoin('a.question', 'q')
            ->innerJoin('q.survey', 's')
            ->where('p.id = :project')
            ->andWhere('s.id = :survey')
            ->setParameter('project', $project)
            ->setParameter('survey', $survey);

        return $qb->getQuery()->getResult();
    }

    public function findProjectAnswer(Project $project, Survey $survey)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id)')
            ->innerJoin(Project::class, 'p', 'WITH', 'a.project = p.id AND p.id = :project')
            ->innerJoin(Survey::class, 's', 'WITH', 's.id = :survey')
            ->innerJoin(AbstractQuestion::class, 'q', 'WITH', 'a.question = q.id AND q.survey = s.id')
            ->setParameter('project', $project)
            ->setParameter('survey', $survey);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
