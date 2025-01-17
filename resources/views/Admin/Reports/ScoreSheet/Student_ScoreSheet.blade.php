@php
    function fun_admin()
    {
        return 'admin';
    }
    $chapter_name = null;
    $ch_id = [];
@endphp
<x-default-layout>
    @section('title', 'ScoreSheet Report')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .table {
            background: #fff !important;
        }

        .table td {
            font-weight: 600;
            color: #787878 !important;
        }

        .selCourse,
        .selChapter,
        .selLesson {
            background-color: transparent !important;
            color: #CF202F !important;
            cursor: pointer;
        }

        .selCourse:focus,
        .selChapter:focus,
        .selLesson:focus {
            color: #CF202F !important;
            background-color: transparent !important;
            border-color: none !important;
            outline: 0;
            box-shadow: none !important;
        }

        .conBtn {
            width: 100% !important;
            background: #FEF5F3 !important;
            color: #CF202F !important;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 5px 20px;
            border: none;
            outline: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .conBtn:hover {
            background: #CF202F !important;
            color: #FEF5F3 !important;
        }
    </style>
    <div class="col-12 mt-3 d-flex flex-column align-items-center gap-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <span style="font-size: 1.6rem;font-weight: 600;color: #CF202F">Score Sheet</span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-2">
            <span class="col-5" style="color: #787878;font-size: 1.4rem;font-weight: 600">Student:
                {{ $student->f_name . ' ' . $student->l_name . '(' . $student->nick_name . ')' }}</span>
            <span class="col-6" style="color: #787878;font-size: 1.4rem;font-weight: 600">Course: <span class="course_name"></span></span>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-start gap-5">

            <select class="selCourse mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Course" id="selCourse">
                <option selected disabled>Select Course</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                @endforeach
            </select>
            <select class="selChapter mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Chapter" id="selChapter">
                <option value="">Select Chapter</option>
            </select>
            <select class="selLesson mx-2"
                style="width: 20%;font-size: 1.4rem;font-weight: 600; border: none;border-radius: 0;"
                name="Course_Lesson" id="selLesson">
                <option value="">Select Lesson</option>
            </select>
            <input type="hidden" value="{{ $courses }}" class="course_data" />
            <input type="hidden" value="{{ $chapters }}" class="chapter_data" />
            <input type="hidden" value="{{ $lessons }}" class="lesson_data" />
        </div>
        <div class="col-12">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <table class="table col-12  mt-2">
                    <thead>
                        <tr>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">QUIZZES </th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Score</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Time</th>
                            <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Date</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Mistakes</th>
                            <th class="col-3" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                scope="col">Reports</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        {{-- <tr>
                            <td style="padding-top: 15px !important">QUIZ 1</td>
                            <td style="padding-top: 15px !important">20/16</td>
                            <td style="padding-top: 15px !important">20M</td>
                            <td style="padding-top: 15px !important">16/6/2024</td>
                            <td><a class="conBtn" href="student_quizzes/id">View Mistakes</a></td>
                            <td><a class="conBtn" href="">Report</a></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <table class="table">
    <thead>
        <th style="border: 1px solid #ccc"></th>
        <th style="border: 1px solid #ccc"></th>
        <th colspan="5" style="border: 1px solid #ccc">Quiz 1</th> 
        <th colspan="5" style="border: 1px solid #ccc">Quiz 2</th>
        <th colspan="5" style="border: 1px solid #ccc">Quiz 3</th>
        <th colspan="5" style="border: 1px solid #ccc">Quiz 4</th>
        <th colspan="5" style="border: 1px solid #ccc">Quiz 5</th>
        <th colspan="5" style="border: 1px solid #ccc">Quiz 6</th>
    </thead>

    <tbody>
        <tr>
            <td style="border: 1px solid #ccc">Chapter</td>
            <td style="border: 1px solid #ccc">Lesson</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
            <td style="border: 1px solid #ccc">Score</td>
            <td style="border: 1px solid #ccc">Time</td>
            <td style="border: 1px solid #ccc">Date</td>
            <td style="border: 1px solid #ccc">View Mistake</td>
            <td style="border: 1px solid #ccc">Report</td>
        </tr>

        @foreach ($payment_req as $item)
            @foreach ($item->chapters_order as $element)
                    @if (!in_array($element->chapter->id, $ch_id) && $element->chapter->chapter_name != $chapter_name)
                 
                    <tr>
                        <td rowspan="{{count($element->chapter->lessons)}}" style="border: 1px solid #ccc">{{$element->chapter->chapter_name}}</td>
                    @endif
                    @if (!in_array($element->chapter->id, $ch_id))
                        
                    @foreach ($element->chapter->lessons as $value)
                        <td style="border: 1px solid #ccc" raw="2">{{$value->lesson_name}}</td>
                        @foreach ($value->quizze as $quiz)
                            @php
                                $student_quizzes = DB::table('student_quizzes')
                                ->where('student_id', auth()->user()->id)
                                ->where('quizze_id', $quiz->id)
                                ->orderByDesc('id')
                                ->first();
                            @endphp
                            <td style="border: 1px solid #ccc">{{@$student_quizzes->score}}</td>
                            <td style="border: 1px solid #ccc">{{@$student_quizzes->time}}</td>
                            @if (!empty($student_quizzes->id))
                            <td style="border: 1px solid #ccc">{{\Carbon\Carbon::parse($student_quizzes->created_at)->format('d-m-Y')}}</td>
                            @endif
                            <td style="border: 1px solid #ccc">
                                @if (!empty($student_quizzes->id))
                                <a href="{{route('quizze_mistakes', ['id' => $student_quizzes->id])}}" class="btn btn-primary mistake_btn">
                                    View Mistakes
                                </a>
                                @endif
                            </td>
                            <td style="border: 1px solid #ccc">
                                @if (!empty($student_quizzes->id))
                                <a href="{{route('quizze_report', ['id' => $student_quizzes->id])}}" class="btn btn-primary mistake_btn">
                                    Report
                                </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endif  

                @php
                $chapter_name = null;
                $ch_id[] = $element->chapter->id;
                @endphp
            @endforeach
        @endforeach
    </tbody>
</table> --}}

    <script>
        let course_data = document.querySelector('.course_data');
        let chapter_data = document.querySelector('.chapter_data');
        let lesson_data = document.querySelector('.lesson_data');
        let course_name = document.querySelector('.course_name');

        let selCourse = document.querySelector('#selCourse');
        let selChapter = document.querySelector('#selChapter');
        let selLesson = document.querySelector('#selLesson');

        course_data = JSON.parse(course_data.value);
        chapter_data = JSON.parse(chapter_data.value);
        lesson_data = JSON.parse(lesson_data.value);

        selCourse.addEventListener('change', () => {
            selChapter.innerHTML = `<option selected disabled>
            Select Chapter</option>`;

            chapter_data.forEach(element => {
                if (element.course_id == selCourse.value) {
                    selChapter.innerHTML += `
                <option value="${element.id}">${element.chapter_name}</option>`;
                }
            });

            let selectedIndex = selCourse.selectedIndex;
            let selectedText = selCourse.options[selectedIndex].text;
            course_name.innerText = selectedText;
        });

        selChapter.addEventListener('change', () => {
            selLesson.innerHTML = `<option selected disabled>
            Select Lesson</option>`;

            lesson_data.forEach(element => {
                if (element.chapter_id == selChapter.value) {
                    selLesson.innerHTML += `
                <option value="${element.id}">${element.lesson_name}</option>`;
                }
            });
        });
        $(document).ready(function() {
            $("#selLesson").change(function() {

                var lessonID = $(this).val()
                $.ajax({
                    url: "{{ route('ad_lesson_score_sheet') }}",
                    type: "GET",
                    data: {
                        user_id: {{ $user_id }},
                        lesson_id: lessonID
                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.data)

                        $(data.data).each((index, ele) => {
                            console.log("ele", ele)
                            var newRow = `<tr>
                                <td style="padding-top: 15px !important">${ele.quizze.title}</td>
                                <td style="padding-top: 15px !important">${ele.score + "/" + ele.quizze.score}</td>
                                <td style="padding-top: 15px !important">${ele.time}</td>
                                <td style="padding-top: 15px !important">${ele.date}</td>
                                <td><a class="conBtn" href="Mistakes/${ele.id}">View Mistakes</a></td>
                                <td><a class="conBtn" href="Quiz/Report/${ele.id}">Report</a></td>
                            </tr>`;

                            $("#myTable").append(newRow)
                        })

                    }
                })
            })
        })
    </script>


</x-default-layout>
{{-- route('lesson_score_sheet') 
    data : {lesson_id : 1}
    MyCourses/Mistakes/1
    Quiz/Report/1

--}}
