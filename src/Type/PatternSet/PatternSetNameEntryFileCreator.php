<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */

namespace Phing\Type\PatternSet;

use Phing\Exception\BuildException;
use Phing\Io\BufferedReader;
use Phing\Io\File;
use Phing\Io\FileReader;
use Phing\Io\IOException;
use Phing\Project;

class PatternSetNameEntryFileCreator extends PatternSetNameEntryCreatorBase
{
    protected $project;

    public function __construct(&$target, Project $p)
    {
        parent::__construct($target);
        $this->project = $p;
    }

    public function setName($n)
    {
        if ($n instanceof File) {
            $n = $n->getPath();
        }
        parent::setName($n);
    }

    public function apply()
    {
        $f = $this->project->resolveFile($this->name);

        if (!$f->exists()) {
            $this->project->log('Pattern file ' . $f->getAbsolutePath() . ' not found.', Project::MSG_WARN);
            return;
        }

        $patternReader = null;
        try {
            // Get a FileReader
            $patternReader = new BufferedReader(new FileReader($f));

            // Create one NameEntry in the appropriate pattern list for each
            // line in the file.
            for (
                $line = $patternReader->readLine();
                $line !== null;
                $line = $patternReader->readLine()
            ) {
                if (!($line = trim($line))) {
                    continue;
                }
                $line = $this->project->replaceProperties($line);
                $this->target[] = $this->create($line);
            }

        } catch (IOException $ioe) {
            $msg = "An error occured while reading from pattern file: " . $f->__toString();
            if ($patternReader) {
                $patternReader->close();
            }
            throw new BuildException($msg, $ioe);
        }

        $patternReader->close();
    }


}